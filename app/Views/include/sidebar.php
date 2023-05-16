<div class="sidebar-account">
				<div class="set">
					<h2><?= $this->auth['first_name'].' '.$this->auth['last_name'] ?></h2>
					<ul>
						<li>
							<a href="<?= base_url('dashboard') ?>">
								Profile<br>
								<small>Learn what's unique to you</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('buy-orders') ?>">
								Buying<br>
								<small>Active Bids, In-Progress, Completed Orders</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('my-selling') ?>" >
								Selling<br>
								<small>Active Asks, In-Progress, Completed Sales</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('my-products') ?>">My Products<br>
								<small>List of your products</small>
							</a>
						</li>
						<!-- <li>
							<a href="<?= base_url('my-orders') ?>">Sell Orders<br>
								<small>List of your orders</small>
							</a>
						</li> -->
					<!-- 	<li>
							<a href="<?= base_url('buy-orders') ?>">Buy Orders<br>
								<small>List of your orders</small>
							</a>
						</li> -->
						<li>
							<a href="<?= base_url('wishlist') ?>">WishList<br>
								<small>List of your wishlist</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('my-wallet') ?>">My Wallet<br>
								<small>List of your earnings</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('account-settings') ?>" >
								Setting<br>
								<small>Learn what's unique to you</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('exchange-order') ?>" >
								Exchange Order<br>
								<small>Pending Order, Approved Order, Rejected Order</small>
							</a>
						</li>
						<li>
							<a href="<?= base_url('logout') ?>">
								Logout
							</a>
						</li>
					</ul>
				</div>
			</div>