<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Models\Product;
use App\Models\Standard;
use App\Models\Cate;
use Log;

class ProductController extends AppBaseController
{
    /** @var  ProductsRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Grade.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $type = $request->input('search', null);
        $products = $this->productRepository->with(['standards', 'cates'])->scopeQuery(function ($query) use ($type) {
            if ($type == 6)
                return $query->where('type', $type);
            return $query->where('type', '!=', 6);
        })->paginate(15);
      
        return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new Grade.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create')->with('uri',
            $this->getURL(route('products.index',
                ['search' => request()->get('search', 1),
                    'searchFields' => request()->get('searchFields', 'status:=')])));
    }

    /**
     * Store a newly created Grade in storage.
     *
     * @param CreateGradeRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect($this->getURL(route('products.index',
            ['search' => $request->get('search', 1),
                'searchFields' => request()->get('searchFields', 'status:=')])));//redirect(route('products.index'));
    }

    /**
     * Display the specified Grade.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);
        

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect($this->getURL(route('products.index', ['search' => 1,
                'searchFields' => request()->get('searchFields', 'status:=')])));//redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product)->with('uri',
            $this->getURL(route('products.index', ['search' => 1, 'searchFields' => 'status:='])));
    }

    /**
     * Show the form for editing the specified Grade.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->scopeQuery(function($query){
            return $query->withTrashed();
        })->with(['standards','cates'])->findWithoutFail($id);
        if (empty($product)) {
            Flash::error('Product not found');

            return redirect($this->getURL(route('products.index',
                ['search' => request()->get('search', 1),
                    'searchFields' => request()->get('searchFields', 'status:=')])));//redirect(route('products.index'));
        }

        return view('products.edit')->with('product', $product)
            ->with('uri', $this->getURL(route('products.index',
                ['search' => request()->get('search', 1),
                    'searchFields' => request()->get('searchFields', 'status:=')])));
    }

    /**
     * Update the specified Grade in storage.
     *
     * @param  int              $id
     * @param UpdateGradeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->scopeQuery(function($query){
            return $query->withTrashed();
        })->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect($this->getURL(route('products.index',
                ['search' => $request->get('search', 1),
                    'searchFields' => request()->get('searchFields', 'status:=')])));//redirect(route('products.index'));
        }

        $product = $this->productRepository->update($request->all(), $id);
        if (!empty(request()->get('change_cate',null))) {
            $this->change_cate($product);
        }
        Flash::success('Product updated successfully.');

        return redirect($this->getURL(route('products.index',
            ['search' => $request->get('search', 1),
                'searchFields' => request()->get('searchFields', 'status:=')])));//redirect(route('products.index'));
    }
    private function change_cate(Product $model){

        $model->standards()->delete();
        $list = array();
        Log::info('standard');
        Log::info(request()->get('standard'));
        if (!empty(request()->get('standard', null))){
            foreach (request()->get('standard') as $k => $v) {
                $list[sizeof($list)] = new Standard(['name' => $v['name'], 'father_name' => $v['father_name'] ?? null, 'sequence' => $v['sequence'] ?? 0]);
            }
            $model->standards()->saveMany($list);
        }
        unset($list);
        $model->cates()->delete();
        $list = array();
        Log::info('cate');
        Log::info(request()->get('cate'));
        if (!empty(request()->get('cate', null))) {
            foreach (request()->get('cate') as $k => $v) {
                $list[sizeof($list)] =
                    new Cate(['name' => $v['name'], 'qty' => $v['qty'] ?? 0, 'pre_price' => $v['pre_price'] ?? 0.00, 'price' => $v['price'] ?? 0.00,
                        'old_price' => $v['old_price'] ?? 0.00, 'base_price' => $v['base_price'] ?? 0.00, 'code' => $v['code'] ?? null,
                        'bar_code' => $v['bar_code'] ?? null, 'weight' => $v['weight'] ?? 0.00]);
            }
            $model->cates()->saveMany($list);
        }
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect($this->getURL(route('products.index',['search'=>1,'searchFields'=>'status:='])));//redirect($this->getURL(route('products.index')));//redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect($this->getURL(route('products.index',
            ['search' => request()->get('search', 1),
                'searchFields' => request()->get('searchFields', 'status:=')])));//route('products.index'));
    }
    public function change(Request $request){
        $status = \request()->post('status',[]);
        $deletes = \request()->post('deletes',[]);
        $change_type = \request()->post('change_type',1);
        if(sizeof($status) > 0){
            $this->productRepository->scopeQuery(function($query) use ($status){
                return $query->withTrashed()->whereIn('id',$status);
            })->get()->map(function($product) use ($change_type){
                $this->productRepository->scopeQuery(function($query){
                    return $query->withTrashed();
                })->update(['status'=>$change_type],$product->id);
            });
        }
        if(sizeof($deletes) > 0){
            $this->productRepository->scopeQuery(function($query) use ($deletes){
                return $query->whereIn('id',$deletes)->withTrashed();
            })->get()->map(function($product){
                $this->productRepository->delete($product->id);
            });
        }
        return redirect($this->getURL(route('products.index',['search'=>1,'searchFields'=>'status:='])));//$request->get('uri',route('products.index',['search'=>1,'searchFields'=>'status:='])));//route('products.index',['search'=>1,'searchFields'=>'status:=']));
    }
    public function trash(Request $request){
        $this->productRepository->pushCriteria(new RequestCriteria($request));

        $products = $this->productRepository->scopeQuery(function($query){
            return $query->onlyTrashed();
        })->paginate(15);
        return view('products.index')->with('products',$products);
    }
    public function untrash(Request $request,$id){
        $this->productRepository->pushCriteria(new RequestCriteria($request));

        $products = $this->productRepository->scopeQuery(function($query){
            return $query->withTrashed();
        })->findWithoutFail($id);
        if (empty($products)){
            Flash::error('Product Not Found');

            return redirect(url('products.trash'));
        }
        $products->restore();
        return redirect($this->getURL(url('products.trash')));//$request->get('uri',url('products.trash')));////redirect(url('products.trash'));
    }
}
