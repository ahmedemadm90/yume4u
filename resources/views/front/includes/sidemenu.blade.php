<div class="contentsticky_verticalmenu verticalmenu-main col-lg-3 col-md-1 d-flex" data-textshowmore="Show More"
    data-textless="Hide" data-desktop_item="4">
    <div class="toggle-nav d-flex align-items-center justify-content-start">
        <span class="btnov-lines"></span>
        <span>أقسام السحوبات</span>
    </div>
    <div class="verticalmenu-content has-showmore ">
        <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novverticalmenu/views/templates/hook/novverticalmenu.tpl -->
        <div id="_desktop_verticalmenu" class="nov-verticalmenu block" data-count_showmore="6">
            <div class="box-content block_content">
                <div id="verticalmenu" class="verticalmenu" role="navigation">
                    <ul class="menu level1">
                        {{-- Categories Was Added By The Admin --}}

                        @foreach (App\Models\Category::whereNull('parent_id')->get() as $cat)
                        <li class="item  parent">
                            <a href="{{route('front.category',$cat->id)}}" title="Laptops &amp; Accessories"><i
                                    class="hasicon nov-icon"></i>{{$cat->category_name}}</a>
                            <span class="show-sub fa-active-sub"></span>
                            <div class="dropdown-menu" style="width:222px">
                                <ul>
                                    {{-- Check If The Categories Has Childrens Or Not --}}
                                    @if (!empty($cat->children))
                                    @foreach ($cat->children as $item)
                                    <li><a class="nav-link"
                                            href="{{route('front.category',$item->id)}}">{{$item->category_name}}</a>
                                    </li>
                                    @endforeach
                                    @else
                                    <li>No Sub Categories Yet</li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novverticalmenu/views/templates/hook/novverticalmenu.tpl -->

    </div>
</div>
