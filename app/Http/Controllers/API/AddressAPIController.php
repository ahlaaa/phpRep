<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateAddressAPIRequest;
use App\Http\Requests\API\UpdateAddressAPIRequest;
use App\Models\Address;
use App\Repositories\AddressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AddressController
 * @package App\Http\Controllers\API
 */

class AddressAPIController extends AppBaseController
{
    /** @var  AddressRepository */
    private $addressRepository;

    public function __construct(AddressRepository $addressRepo)
    {
        $this->addressRepository = $addressRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/addresses",
     *      summary="Get a listing of the Addresses.",
     *      tags={"收货地址"},
     *      description="获取所有收货地址",
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
     *                  @SWG\Items(ref="#/definitions/Address")
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
        $this->addressRepository->pushCriteria(new RequestCriteria($request));
        $this->addressRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->addressRepository->pushCriteria(new AuthCriteria());
        $addresses = $this->addressRepository->all();

        return $this->sendResponse($addresses->toArray(), '收货地址获取成功');
    }

    /**
     * @param CreateAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/addresses",
     *      summary="Store a newly created Address in storage",
     *      tags={"收货地址"},
     *      description="Store Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Address that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Address")
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
     *                  ref="#/definitions/Address"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAddressAPIRequest $request)
    {
        $input = $request->all();

        $addresses = $this->addressRepository->create($input);

        return $this->sendResponse($addresses->toArray(), '收货地址保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/addresses/{id}",
     *      summary="Display the specified Address",
     *      tags={"收货地址"},
     *      description="Get Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
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
     *                  ref="#/definitions/Address"
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
        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('收货地址未找到');
        }

        return $this->sendResponse($address->toArray(), '收货地址获取成功');
    }

    /**
     * @param int $id
     * @param UpdateAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/addresses/{id}",
     *      summary="Update the specified Address in storage",
     *      tags={"收货地址"},
     *      description="Update Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Address that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Address")
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
     *                  ref="#/definitions/Address"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAddressAPIRequest $request)
    {
        $input = $request->all();

        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('收货地址未找到');
        }

        $address = $this->addressRepository->update($input, $id);

        return $this->sendResponse($address->toArray(), '收货地址更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/addresses/{id}",
     *      summary="Remove the specified Address from storage",
     *      tags={"收货地址"},
     *      description="Delete Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
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
        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('收货地址未找到');
        }

        $address->delete();

        return $this->sendResponse($id, '收货地址删除成功');
    }
}
