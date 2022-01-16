<div class="col-lg-9 col-md-11 header-menu d-flex align-items-center justify-content-start">
    <div class="header-menu-search d-flex justify-content-between w-100 align-items-center">

        <div id="_desktop_top_menu">

            <!-- begin modules/novmegamenu/views/templates/hook/novmegamenu.tpl -->
            <nav id="nov-megamenu" class="clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div id="megamenu" class="nov-megamenu clearfix">


                    <ul class="menu level1">



                        <li class="item home-page"><span class="opener"></span><a href="/" title="Home"><i
                                    class="zmdi zmdi-home"></i>الرئيسية</a></li>

                        <li class="item">
                            <a class="nav-link" href="/lotteries"> السحوبات </a>
                        </li>
                        <li class="item">
                            <a class="nav-link" href="/about"> من نحن </a>
                        </li>
                        <li class="item">
                            <a class="nav-link" href="/contact">إتصل بنا</a>
                        </li>



                    </ul>
                </div>
            </nav>
            <!-- end modules/novmegamenu/views/templates/hook/novmegamenu.tpl -->

        </div>

        <div class="advencesearch_header">
            <span class="toggle-search hidden-lg-up"><i class="zmdi zmdi-search"></i></span>
            <div id="_desktop_search" class="contentsticky_search">

                <!-- begin modules/novadvancedsearch/novadvancedsearch-top.tpl -->
                <!-- block seach mobile -->
                <!-- Block search module TOP -->
                <div id="desktop_search_content" data-id_lang="6" data-ajaxsearch="1" data-novadvancedsearch_type="top"
                    data-instantsearch="" data-search_ssl=""
                    data-link_search_ssl="http://demo.bestprestashoptheme.com/savemart/ar/بحث"
                    data-action="http://demo.bestprestashoptheme.com/savemart/ar/module/novadvancedsearch/result">
                    <form method="get" action="" id="searchbox" class="form-novadvancedsearch">
                        <div class="input-group">
                            <input type="text" id="search_query_top"
                                class="search_query ui-autocomplete-input form-control" name="search_query" value=""
                                placeholder="Search" />

                            <div class="input-group-btn nov_category_tree hidden-sm-down">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" value="" aria-expanded="false">
                                    CATEGORIES
                                </button>
                                <ul class="dropdown-menu list-unstyled">
                                    <li class="dropdown-item active" data-value="0"><span>All Categories</span></li>
                                    <ul class="list-unstyled pl-5">
                                        @foreach(App\Models\Category::whereNull('parent_id')->orderBy('category_name')->get()
                                        as $category)
                                        <li class="dropdown-item" value="{{$category->id}}" name="{{$category->id}}">
                                            <span class="text-danger">{{$category->category_name}}</span>
                                        </li>
                                        @if ($category->has('children'))
                                        <ul class="list-unstyled pl-5">
                                            @foreach ($category->children as $item)
                                            <li class="dropdown-item" value="{{$item->id}}">
                                                <span class="text-primary">{{$item->category_name}}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                        @endforeach
                                        {{-- <li class="dropdown-item" data-value="3">
                                            <span>Computer &amp; Networking</span>
                                        </li> --}}
                                    </ul>
                                </ul>
                            </div>

                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" name="submit_search"><i
                                        class="material-icons">search</i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /Block search module TOP -->

                <!-- end modules/novadvancedsearch/novadvancedsearch-top.tpl -->

            </div>
        </div>
    </div>
</div>
