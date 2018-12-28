<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Models\Giveaway;
use App\Models\Log;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orders",
     *      summary="Get a listing of the Orders.",
     *      tags={"订单"},
     *      description="Get all Orders",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Order")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->orderRepository->pushCriteria(new AuthCriteria());

        $orders = $this->orderRepository->with(['user','cates','product'])->scopeQuery(function ($query){
            return $query->where('user_id',\Auth::user()->id)->orderBy('created_at','desc');
        })->paginate();

        return $this->sendResponse($orders->toArray(), 'Orders获取成功');
    }

    public function storeOrders(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));

        $store = \Auth::user()->store;

        $this->orderRepository->scopeQuery(function ($query) use ($store) {
            $query->where('store_id', optional($store)->id);
            return $query;
        });

        $orders = $this->orderRepository->paginate();

        return $this->sendResponse($orders->toArray(), 'Orders获取成功');
    }

    /**
     * @param CreateOrderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orders",
     *      summary="Store a newly created Order in storage",
     *      tags={"订单"},
     *      description="Store Order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderAPIRequest $request)
    {
        $input = $request->all();
        $saplings = optional(optional(\Auth::user())->saplingsSmall)->count()??0;
        if ($request->input('otype',2) == 1 && $saplings >= 3)
            return $this->sendError('树苗已达上限',401);
        if ($request->input('otype',2) == 5) {
            $flag = Order::checkProx($input);
//            \Log::info('flag::'.$flag);
            if (empty($flag))
                return $this->sendError('申请失败,地区已存在用户/金额不足', 401);
        }
        if (array_get($input,'otype') == 3){
            $prox = \DB::table('grade_user')->where([['user_id',\Auth::user()->id],['type',3],['status',1]])->first();
            if (empty($prox))
                return $this->sendError('申请失败,不到代理商等级', 401);
        }
        $orders = $this->orderRepository->create($input);
        if ($request->input('otype',2) == 5)
            Order::addApplication($input,$orders);
//        if (array_get($input,'otype') == 3)
//            Order::assUsers($orders);
        return $this->sendResponse($orders->toArray(), '订单保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orders/{id}",
     *      summary="Display the specified Order",
     *      tags={"订单"},
     *      description="Get Order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository/*->with(['cates','product'])*/->findWithoutFail($id);

        $order->load('product', 'cates');

        if (empty($order)) {
            return $this->sendError('订单未找到');
        }

        return $this->sendResponse($order->toArray(), '订单获取成功');
    }

    /**
     * @param int $id
     * @param UpdateOrderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orders/{id}",
     *      summary="Update the specified Order in storage",
     *      tags={"订单"},
     *      description="Update Order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('订单未找到');
        }

        $order = $this->orderRepository->update($input, $id);

        return $this->sendResponse($order->toArray(), '订单更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orders/{id}",
     *      summary="Remove the specified Order from storage",
     *      tags={"订单"},
     *      description="Delete Order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('订单未找到');
        }

        $order->delete();

        return $this->sendResponse($id, '订单删除成功');
    }

    public function statistics(Request $request)
    {
//        $province = $request->get('province');
//        $city = $request->get('city');

        $data = $this->orderRepository->with(['address', 'store'])->scopeQuery(function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->whereIn('delivery_type', [1,2])->when($request->get('province'), function ($query) use ($request) {
                    return $query->whereHas('store', function ($query) use ($request) {
                        return $query->where('province', $request->get('province'));
                    });
                });
            })->orWhere(function ($query) use ($request) {
                $query->where('delivery_type', 3)->when($request->get('province'), function ($query) use ($request) {
                    return $query->whereHas('address', function ($query) use ($request) {
                        return $query->where('province', $request->get('province'));
                    });
                });
            });
            return $query;
        })->all();

        return $this->sendResponse($data, '成功');
    }
}
