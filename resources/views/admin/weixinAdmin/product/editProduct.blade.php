@extends('admin.adminMaster')




@section('resources')
    <script src={{ asset('js/webuploader/webuploader.js') }}></script>
    <link rel="stylesheet" type="text/css"  href={{ asset('js/webuploader/webuploader.css') }}>
@stop

@section('content')


    <div class="f-left right-side-panel" >

        <div class="breadcrumb-nav">
            <div class="ui  large breadcrumb">
                <a class="section">主页</a>
                <i class="right angle icon divider"></i>
                <a class="section">编辑商品</a>
            </div>
        </div>

        @if(isset($message))
            <div class="errorMessage ">
                {{$message}}
            </div>
        @endif


        <form class="new-product-form" id="updateProductForm">

            <input type="hidden" id="productId" name="productId" value="{{$product->id}}" />
            <input type="hidden" id="selectCat" name="selectCat" value="{{$product->category_id}}" />
            <input type="hidden" id="selectBrand" name="selectBrand" value="{{$product->brand_id}}"/>
            <input type="hidden" id="selectType" name="selectType" value="{{$product->type}}"/>
            {!! csrf_field() !!}
            @include('admin.weixinAdmin.product.productDetail')
            <div  class=" ui button red" id="submitUpdate" style="margin:10px 0;display: inline-block;"> 保存更改</div>
            <div>
                <a href="{{url('/weixin/admin/product/addImage').'/'.$product->id}}"  class=" ui button  blue " id="submit"> 编辑产品图片</a>
                <a href="{{url('/weixin/admin/product/editProductSpec').'/'.$product->id}}"  class=" ui button  blue " id="submit"> 编辑产品属性</a>
            </div>
        </form>

    </div>



@stop

@section('script')
    <script type="text/javascript">


        $(document).ready(function(){

            $('.angle.down').click(function(){
                $(this).siblings('.sub-menu').slideToggle(300);
            })


            if(($('.errorMessage').hasClass('errorMessage') !== false))
            {

                _showToaster($('.errorMessage').text())
            }

            $('#inventory,#price,#promotePrice').keyup(function(){

                $(this).val($(this).val().replace(/[^0-9.]/g,''));

            }).bind("paste",function(){  //CTR+V事件处理
                $(this).val($(this).val().replace(/[^0-9.]/g,''));
            }).css("ime-mode", "disabled"); //CSS设置输入法不可用

            //设置产品分类选中值
            $(".select-cat").val($('#selectCat').val());

            //设置产品品牌选中值
            $(".select-brand").val($('#selectBrand').val());

            //设置产品类别选中值
            $('.select-type').val($('#selectType').val());

            $(' .select-cat').dropdown({
                onChange: function(value, text, $selectedItem) {
                    $('#selectCat').val(value);
                }
            });

            $(' .select-brand').dropdown({
                onChange: function(value, text, $selectedItem) {
                    $('#selectBrand').val(value);
                }
            })

            $(' .select-type').dropdown({
                onChange: function(value, text, $selectedItem) {
                    $('#selectType').val(value);
                }
            })



            if('{{$product->status}}' === '1')
            {

                $('#status').attr("checked", true);
            }
            if('{{$product->promoteStatus}}' === '1')
            {
                $('#promoteStatus').attr("checked", true);
            }

            if ('{{$product->is_new}}' === '1') {
                $('#is_new').attr("checked", true);
            }
            if ('{{$product->is_hot}}' === '1') {
                $('#is_hot').attr("checked", true);
            }
            if ('{{$product->is_recommend}}' === '1') {
                $('#is_recommend').attr("checked", true);
            }


            $('#submitUpdate').click(function(){

                $.ajax({
                    url:"/weixin/admin/product/edit",
                    data:$("#updateProductForm").serialize(),
                    type:"post",
                    dataType:'json',
                    success:function(data){
                            _showToaster(data.statusMsg);
                    },
                    error: function (xhr, type) {
                    }
                });

            })

//            $('#submit').click(function(){
//
//
//                $('#productDetialFields').slideToggle();
//
//                $('.product-image-upload').fadeIn();
//            })



        })
    </script>
@stop