<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyCommentRequest;
use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\ProductDetails\ProductDetailRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $comment, $product, $category, $productDetails;
    function __construct (
        CommentRepositoryInterface $comment,
        ProductDetailRepositoryInterface $productDetails,
        CategoryRepositoryInterface $category,
        ProductRepositoryInterface $product
    ) {
        $this->productDetails = $productDetails;
        $this->category = $category;
        $this->product = $product;
        $this->comment = $comment;
        $categories = $this->category->getAll();
        view()->share('categories', $categories);
    }

    public function index()
    {
        $products = $this->product->paginate(config('setting.paginate.product'));

        return view('users.pages.product', compact('products'));
    }

    public function show($id)
    {
        try {
            $data = [
                'comments',
                'images',
                'productDetails',
            ];
            $product = $this->product->getRelated($id, $data);
            $images = $product->images;
            $productDetails = $product->productDetails;
            $comments = $product->comments->where('parent_id', '=', null);

            return view('users.pages.product_detail', compact('product', 'images', 'productDetails', 'comments'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function quantity($id)
    {
        try {
            $productDetails = $this->productDetails->find($id);
            $data = [
                'quantity' => $productDetails->quantity,
                'size' => $productDetails->size,
            ];

            return json_encode($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function comment(CommentRequest $request, $id)
    {
        $data = ['comments'];
        $product = $this->product->find($id, $data);
        $comment = $product->comments->where('user_id', Auth::user()->id)->first();
        if (empty($comment)) {
            $data = [
                'product_id' => $id,
                'user_id' => Auth::user()->id,
                'message' => $request->comment,
                'rate' => $request->rating,
                'status' => config('setting.comment.accept'),
            ];
            $this->comment->create($data);
        } else {
            $data = [
                'message' => $request->comment,
                'rate' => $request->rating,
                'status' => config('setting.comment.accept'),
            ];
            $this->comment->update($comment->id, $data);
        }
        $attributeRate = [
            ['product_id', '=', $id],
            ['parent_id', '=', null],
        ];
        $avg = $this->comment->where($attributeRate)->avg('rate');
        $dataRate = [
            'rate' => round($avg),
        ];
        $this->product->update($id, $dataRate);

        return redirect()->back();
    }

    public function replyComment(ReplyCommentRequest $request, $commentId, $productId)
    {
        $data = [
            'product_id' => $productId,
            'user_id' => Auth::user()->id,
            'parent_id' => $commentId,
            'message' => $request->reply,
            'rate' => config('setting.rate'),
            'status' => config('setting.comment.accept')
        ];
        $this->comment->create($data);

        return redirect()->back();
    }

    public function deleteComment($id)
    {
        $comment = $this->comment->find($id, ['replies']);
        $replies = $comment->replies;
        if (Auth::user()->can('delete', $comment)) {
            if ($replies) {
                foreach ($replies as $reply) {
                    $this->comment->delete($reply->id);
                }
            }
            $this->comment->delete($id);

            return redirect()->back();
        }

        return abort(config('setting.errors404'));
    }

    public function getProductByCategory($id)
    {
        $data = [
            ['category_id', $id],
        ];
        $products = $this->product->where($data)->paginate(config('setting.paginate.product'));

        return view('users.pages.product', compact('products'));
    }

    public function filterByPrice(Request $request)
    {
        $products = $this->product->filterWhere($request->price_from, $request->price_to);

        return view('users.pages.product', compact('products'));
    }
}
