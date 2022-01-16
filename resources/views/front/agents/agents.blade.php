@extends('layouts.site')
@section('content')
<div id="wrapper-site">
    <div class="no-index">
        <section id="main" itemscope="" itemtype="#">
            <div id="content-wrapper">
                <div class="product-detail-top">
                    <h2 class="text-center mb-25">الوكلاء المعتمدون</h2>
                    <div class="container">
                        <table class="table table-dark w-75 m-auto font-weight-bold text-center">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>{{ trans('Name')}}</td>
                                    <td>{{ trans('Mobile') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agents as $agent)
                                <tr>
                                    <td>{{$agent->id}}</td>
                                    <td>{{$agent->name}}</td>
                                    <td>{{$agent->mobile}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>

            </div>
    </div>

    <div class="modal fade js-product-images-modal" id="product-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <figure>
                        <img class="js-modal-product-cover product-cover-modal" width="600"
                            src="http://demo.bestprestashoptheme.com/savemart/34-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                            alt="" title="" itemprop="image">
                    </figure>
                    <aside id="thumbnails" class="thumbnails js-thumbnails text-xs-center">

                        <div class="js-modal-mask mask  nomargin ">

                        </div>

                    </aside>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </section>
</div>

@endsection
