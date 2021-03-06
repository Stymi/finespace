@extends('admin.adminMaster')




@section('resources')

@stop

@section('content')


    <div class="f-left right-side-panel ">


        <div class="breadcrumb-nav">
            <div class="ui  large breadcrumb">
                <a class="section" href="{{url('/weixin/admin')}}">主页</a>
                <i class="right angle icon divider"></i>
                <a class="section">产品管理</a>
            </div>
        </div>



        <div class="product-table">

            {{--<form method="post" action="/weixin/admin/product/seachProduct">--}}
                {{--<div class="ui icon input search-bar">--}}

                    {{--<div class="field">--}}

                        {{--<select class="ui fluid dropdown" name="category">--}}
                            {{--<option value="0">选择分类</option>--}}
                            {{--@foreach($category as $cate)--}}
                                {{--<option value="{{$cate->id}}">{{$cate->name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="field">--}}

                        {{--<select class="ui fluid dropdown" name="jxrc">--}}
                            {{--<option value="0">全部</option>--}}
                            {{--<option value="1">推荐</option>--}}
                            {{--<option value="2">新品</option>--}}
                            {{--<option value="3">热销</option>--}}
                            {{--<option value="4">促销</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="field">--}}

                        {{--<select class="ui fluid dropdown" name="status">--}}
                            {{--<option value="0">全部</option>--}}
                            {{--<option value="1">上架</option>--}}
                            {{--<option value="2">下架</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}

                    {{--<input type="text" placeholder="请输入..." id="seachData" name="searchData" >--}}
                    {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                    {{--<button class="ui circular search link icon button submit-btn" type="submit">--}}
                        {{--<i class="search link icon"></i>--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</form>--}}



            <form method="post" action="/weixin/admin/product/rank">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="ui icon input search-bar">


                    <div class="field">

                        <select class="ui fluid dropdown" name="orderBy">
                            <option value="0">排序</option>
                            @if($orderBy!=null && $orderBy ==1 )
                                <option value="1" selected>销量最好</option>
                                <option value="2">销量最差</option>
                            @elseif  ($orderBy!=null && $orderBy ==2 )
                                <option value="1" >销量最好</option>
                                <option value="2" selected>销量最差</option>
                            @else
                                <option value="1">销量最好</option>
                                <option value="2">销量最差</option>
                            @endif
                        </select>
                    </div>
                    <div class="field">

                        <select class="ui fluid dropdown" name="category">
                            <option value="0">分类</option>
                            @foreach($categories as $category)
                                @if($category->parent_id!=0)
                                    @if($categorySelected != null && $categorySelected == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                     @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button class="ui circular search link icon button submit-btn" type="submit">
                        <i class="search link icon"></i>
                    </button>
                </div>
            </form>



            <table class="ui primary striped selectable table ">
                <thead>
                <tr>
                    <th>商品ID</th>
                    <th>名称</th>
                    <th>库存</th>

                    <th>状态</th>
                    <th>新品</th>
                    <th>热销</th>
                    <th>推荐</th>
                    <th>总销量</th>

                </tr>
                </thead>
                <tbody>
                @if(count($products)==0)
                   <tr> <td>没有找到商品</td></tr>
                @endif

                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>

                        <td>{{$product->price}}</td>
                        <td>
                            @if($product->status == 1)
                                上架
                            @elseif($product->status == 0)
                                下架
                            @endif
                        </td>

                        <td>
                            @if($product->is_new == 1)
                                <i class="blue checkmark icon" onclick="IsChange({{$product->id}},'new',{{$product->is_new}})" id="new_C_{{$product->id}}"></i>
                            @elseif($product->is_new == 0)
                                <i class="red remove icon" onclick="IsChange({{$product->id}},'new',{{$product->is_new}})" id="new_R_{{$product->id}}"></i>
                            @endif
                        </td>
                        <td>
                            @if($product->is_hot == 1)
                                <i class="blue checkmark icon" onclick="IsChange({{$product->id}},'hot',{{$product->is_hot}})" id="hot_C_{{$product->id}}"></i>
                            @elseif($product->is_hot == 0)
                                <i class="red remove icon" onclick="IsChange({{$product->id}},'hot',{{$product->is_hot}})" id="hot_R_{{$product->id}}"></i>
                            @endif
                        </td>
                        <td>
                            @if($product->is_recommend == 1)
                                <i class="blue checkmark icon" onclick="IsChange({{$product->id}},'recommend',{{$product->is_recommend}})" id="recommend_C_{{$product->id}}"></i>
                            @elseif($product->is_recommend == 0)
                                <i class="red remove icon" onclick="IsChange({{$product->id}},'recommend',{{$product->is_recommend}})" id="recommend_R_{{$product->id}}"></i>
                            @endif
                        </td>

                        <td>{{$product->totalSale}}</td>
                    </tr>

                @endforeach

                </tbody>

                <th colspan="3" style="padding:2px;">
                    <div>
                        {!! $products->appends(['orderBy'=>$orderBy,'category'=>$categorySelected])->render() !!}
                    </div>
                </th>

            </table>
            <div class="table-content">

                <a class="f-right ui button primary" href="{{url('/weixin/admin/product/add')}}">添加商品</a>
            </div>
        </div>

    </div>



@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.angle.down').click(function(){
                $(this).siblings('.sub-menu').slideToggle(300);
            })
        })

        function IsChange(id,name,status){
            $.ajax({
                type: 'POST',
                url: '/weixin/admin/product/changeStatus',
                data: {productId : id , StatusName : name , status : status},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){

                    if (data.statusId.changeStatus == 1) {
                        $("#"+data.statusId.ReturnId).removeClass("red").removeClass("remove").addClass("blue").addClass("checkmark");
                    }else{
                        $("#"+data.statusId.ReturnId).removeClass("blue").removeClass("checkmark").addClass("red").addClass("remove");
                    }

                    alert(data.statusMsg);
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        }
    </script>
@stop