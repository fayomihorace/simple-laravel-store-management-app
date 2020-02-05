<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{session('utilisateur')[0]->username}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{__('En Ligne')}}</a>
            </div>
        </div>
    <!--form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form-->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="treeview">
                <a href="{{ url('/') }}"><i
                        class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>

            {{-- Navigation --}}
            <li class="header">NAVIGATION</li>
            <li class="treeview @if( Request::is('admin/produit*') || Request::is('admin/ajout*') || Request::is('admin/categorie*')   ) active @endif">
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span>{{__('Produits') }} </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" @if( Request::is('admin/produit*') ) active @endif"><a href="{{ url('/admin/produit/') }}"><i class="fa fa-circle-o"></i>
                            {{__('Liste Produits')}}</a></li>
                    <li class=" @if( Request::is('admin/ajout*') ) active @endif"><a href="{{ url('/admin/ajout-stock') }}"><i class="fa fa-circle-o"></i>
                            {{__('Ajout de Stock ')}}</a></li>
                    <li class=" @if( Request::is('admin/categorie*')   ) active @endif"><a href="{{ url('/admin/categorie') }}"><i class="fa fa-circle-o"></i>
                            {{__('Categories')}}</a></li>        
                </ul>
            </li>
            <li class="treeview @if( Request::is('admin/magazin*') || Request::is('admin/produit-magazin*') ) active @endif">
                <a href="#">
                    <i class="fa fa-truck"></i> <span>{{ __('Magazins') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" @if( Request::is('admin/magazin') ) active @endif"><a href="{{ url('/admin/magazin') }}"><i
                                class="fa fa-circle-o"></i> {{__('Liste Magasins')}}</a></li>
                    <li class=" @if( Request::is('admin/produit-magazin*') ) active @endif"><a href="{{ url('/admin/produit-magazin') }}"><i class="fa fa-circle-o"></i>
                            {{__('Produits / Magasin')}}</a></li>
                </ul>
            </li>
            <li class="treeview @if( Request::is('admin/operation') || Request::is('admin/operation/*') ) active @endif">
                <a href="{{ url('/admin/operation') }}"><i
                                class="fa fa-circle-o"></i> {{__('Operations')}}</a>
            </li>

            <li class="treeview @if( Request::is('admin/membre*') || Request::is('admin/membre/*')   ) active @endif">
            <a href="{{ url('/admin/membre') }}"><i
                                class="fa fa-circle-o"></i> {{__('Membres')}}</a>
            </li>
            <li class="treeview  @if( Request::is('admin/responsable/*') || Request::is('admin/responsable')  ) active @endif">
                <a href="{{ url('/admin/responsable') }}"><i class="fa fa-circle-o"></i>
                            {{__('Responsables')}}</a>
            </li>

            <li class="treeview @if( Request::is('admin/fournisseur*') || Request::is('admin/fournisseur/*') ) active @endif">
                <a href="{{ url('/admin/fournisseur') }}"><i
                                class="fa fa-circle-o"></i> {{__('Fournisseurs')}}</a>
            </li>

           

            <li class="header">{{__('Liens Rapides')}}</li>
            <li class="@if(Request::is('sales/create')) active @endif"><a
                    href="{{ url('/admin/operation') }}"><i class="fa fa-circle-o text-success"></i> <span>{{__('Liste des Operation')}}</span></a></li>
            <li class="@if(Request::is('supplier/create')) active @endif"><a
                    href="{{url('/admin/operation/create')}}"><i
                        class="fa fa-circle-o text-aqua"></i> <span>{{__('Ajouter une Opération')}}</span></a></li>
            <li class="@if(Request::is('customer/create')) active @endif"><a
                    href="{{url('/admin/ajout-stock/create')}}"><i
                        class="fa fa-circle-o text-yellow"></i> <span>{{__('Ajout de stock')}}</span></a></li>

            {{-- END OF Direct Links --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>