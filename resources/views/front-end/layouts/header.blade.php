	
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content" style="margin-right: 0%">
							<ul class="list-main">
								<form action="{{ url('/logout') }}" method="post" id="logoot">
									@csrf
								</form>
                            @if (Auth::check())
								<li><i class="ti-user"></i> <a href="{{ url('profile') }}">{{ Auth::user()->name }}</a></li>
								<li><i class="ti-power-off"></i><a href="#" onclick="logout()" >Keluar</a></li>
                            @else
								<li><a href="{{ route('user.login') }}">Masuk</a></li>
								<li><a href="{{ route('register') }}">Daftar</a></li>
                            @endif
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
			<!-- <style>
				<h1>  Bina Media Sarana </h1>
				h1 {
				font-size: 26pt;
				position: absolute;
				top: 0;
				left: 0;
				}
			</style> -->
			
		<style>
			h1 {
				font-size: 36pt;
				position: absolute;
			
				left: 28%; /* Mengubah nilai left menjadi 50% */
				transform: translateX(-50%); /* Menambahkan transformasi translateX untuk menggeser tulisan ke kiri sejauh 50% */
			}
		</style>
		</div>
		<!-- End Topbar -->
		
		<div class="middle-inner">
			<div class="logo ml-3">
				<h1 style="color:black">Bina Media Sarana</h1>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-2 col-12">
						
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="{{ url('') }}"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">        
								<form class="search-form">
									<input type="text" placeholder= "Cari disini..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-7 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar" id="cari_1" style="width: 0px;">                          
								<button class="btnn" onclick="okelah()"><i class="ti-search"></i></button>
							</div>
							<div class="search-bar" id="cari_2" style="display: none;">                          
								<form action="{{ url('') }}" method="get">
									<input name="search" placeholder="Ketik Judul Disini" type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						{{-- <div class="col-lg-3">
							</div>
						</div> --}}
						<div class="col-lg-12 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<!-- /* <div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li ><a href="{{ route('home') }}">Beranda</a></li>
													@if (Auth::check())
														<li><a href="{{ route('transaksi') }}">Transaksi</a>  </li>
													@endif
													<li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
												</ul>
										</div> */ -->
										
		
										<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
<<<<<<< HEAD
											<li><a href="{{ route('home') }}" style="font-size: 26px;">Beranda</a></li>
											@if (Auth::check())
											<li><a href="{{ route('transaksi') }}" style="font-size: 26px;">Transaksi</a></li>
											@endif
											<li><a href="{{ route('contact') }}" style="font-size: 26px;">Hubungi Kami</a></li>
=======
											<li><a href="{{ route('home') }}" style="font-size: 28px;left:0%;">Beranda</a></li>
											@if (Auth::check())
											<li><a href="{{ route('transaksi') }}" style="font-size: 28px;left:5%">Transaksi</a></li>
											@endif
											<li><a href="{{ route('contact') }}" style="font-size: 28px;left:5%">Hubungi Kami</a></li>
>>>>>>> 62aaa4a (update dari sana)
										</ul>
										</div>

									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>

	<script>
		function logout(){
			$('#logoot').submit();
		}
	</script>