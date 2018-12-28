<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserOrder;
use App\Repositories\ExpressRepository;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));

        $orders = $this->orderRepository->with(['user','address'])->scopeQuery(function ($query){
            return $query;//->where('otype','!=',3);
        })->paginate(15);
        
        return view('orders.index')
            ->with('orders', $orders);
//        return view('orders.fields');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create(ExpressRepository $expressRepository)
    {

        return view('orders.create', [
            'expresses' => $expressRepository->pluck('name', 'name'),
            'customer' => app(UserRepository::class)->customers(),
        ]);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

//        if (array_get($input,'otype') == 3)
//            Order::assUsers($order);
        Flash::success('Order 保存成功');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(ExpressRepository $expressRepository,$id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }
        $order->load('users','routes','inorder');
        return view('orders.edit')
            ->with('order', $order)
            ->with('customer', app(UserRepository::class)->customers())
            ->with('expresses', $expressRepository->pluck('name', 'name'));
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        // return $order;

        Flash::success('Order 更新成功.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }
}
