			<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div>

				<ul class="nav nav-list">
					<li>
						<a href="<?php echo base_url()?>index.php/dashboard">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url()?>index.php/karyawan">
							<i class="icon-user"></i>
							<span class="menu-text"> Karyawan </span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url()?>index.php/pelanggan">
							<i class="icon-user green"></i>
							<span class="menu-text"> Pelanggan </span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url()?>index.php/pemasok">
							<i class="icon-user red"></i>
							<span class="menu-text"> Pemasok </span>
						</a>
					</li>
					

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="icon-file-alt"></i>

							<span class="menu-text">
								Data Produk
								<span class="badge badge-primary ">4</span>
							</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="<?php echo base_url()?>index.php/kategori_produk">
									<i class="icon-double-angle-right"></i>
									Kategori Produk
								</a>
							</li>

							<li>
								<a href="<?php echo base_url()?>index.php/merk_produk">
									<i class="icon-double-angle-right"></i>
									Merk Produk
								</a>
							</li>

							<li>
								<a href="<?php echo base_url()?>index.php/ukuran_produk">
									<i class="icon-double-angle-right"></i>
									Ukuran Produk
								</a>
							</li>

							<li class="">
								<a href="<?php echo base_url()?>index.php/produk">
									<i class="icon-double-angle-right"></i>
									Produk
								</a>
							</li>
						</ul>
					</li>
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>