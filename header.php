<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site" style="
    background: #003b5c;
    color: #fff;
">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">PACIFIC CENTER for<br/>LIFELONG LEARNING</a></p>
		</div><!-- .site-branding -->

		<style>
		    .navigation {
		        background: #3180c2;
		        font-family: "Catamaran", "Arial Narrow", Arial, Helvetica, sans-serif;
		        font-size: 18px;
		    }

		    .navigation__list {
		        zoom: 1;
		        background: #fff;
		        margin: 0;
		        padding: 0;
		        font-family: "Roboto", "Arial Narrow", Arial, Helvetica, sans-serif;
		        font-size: 18px;
		        font-weight: 400;
		        width: 100%;
		        display: flex;
		        flex-wrap: nowrap;
		        list-style: none;
			justify-content: center;
		    }

		    #navigation .navigation__list a {
		        text-decoration: none;
		        color: #003b5c;
		        border-left: 1px solid #003b5c;
		        padding: 15px 10px;
		        display: inline-block;
		        width: 100%;
		        text-align: center;
		    }

			#navigation .navigation__list .navigation__list__last {
				border-right: 1px solid #003b5c;
			}

		    #navigation .navigation__list a:hover {
		        background-color: #003b5c;
		        color: #fff;
		    }

		    #navigation .navigation__list li {
		        width: 16.6%;
		    }

		    .navigation__list ul {
		        list-style: none;
		        z-index: 1000;
		    }

		    .navigation__drop {
		        position: absolute;
		        width: 16.6%;
		        display: block;
		    }

		    #navigation ul.navigation__drop li {
		        width: 100%;
		        background: #3180c2;
		    }

		    input.navigation__checkbox {
		        display: none;
		    }

		    .navigation__button {
		        background-color: #3180c2;
		        position: relative;
		        margin: 0 auto;
		        z-index: 2000;
		        text-align: center;
		        cursor: pointer;
		    }

		    .navigation__icon {
		        position: relative;
		        margin-top: 22px;
		    }

		    .navigation__icon,
		    .navigation__icon::before,
		    .navigation__icon::after {
		        width: 2rem;
		        height: 4px;
		        background-color: #fff;
		        display: inline-block;
		    }

		    .navigation__icon::before,
		    .navigation__icon::after {
		        content: "";
		        position: absolute;
		        left: 0;
		        transition: all 0.2s;
		    }

		    .navigation__icon::before {
		        top: -0.8rem;
		    }

		    .navigation__icon::after {
		        top: 0.8rem;
		    }

		    .navigation__button:hover .navigation__icon::before {
		        top: -1rem;
		    }

		    .navigation__button:hover .navigation__icon::after {
		        top: 1rem;
		    }

		    .navigation__checkbox:checked+.navigation__button .navigation__icon {
		        background-color: transparent;
		    }

		    .navigation__checkbox:checked+.navigation__button .navigation__icon::before {
		        top: 0;
		        transform: rotate(135deg);
		    }

		    .navigation__checkbox:checked+.navigation__button .navigation__icon::after {
		        top: 0;
		        transform: rotate(-135deg);
		    }

		    .navigation label {
		        user-select: none;
		    }

		    .navigation__mobile {
		        display: none;
		    }

		    @media all and (max-width: 1092px) {
		        .navigation__mobile {
		            display: block;
		        }

		        #navigation .navigation__list li {
		            width: 100%;
		            padding: 0;
		        }

		        .navigation__list li a {
		            padding: 1rem 0;
		            border-left: none;
		            border-top: 1px solid #2c73af;
		        }

		        .navigation__drop {
		            position: relative;
		            width: 100%;
		            border: 2px solid #fff;
		        }

		        .navigation__checkbox~.navigation__list {
		            display: none;
		        }

		        .navigation__checkbox:checked~.navigation__list {
		            display: block;
		        }
		    }

		    .hidden {
		        display: none;
		    }
		</style>
		<nav id="navigation" class="navigation" role="navigation">
			<input #navigation type="checkbox" class="navigation__checkbox" id="navi-toggle">
			<label for="navi-toggle" class="navigation__mobile navigation__button">
			    <span class="navigation__icon">&nbsp;</span>
			</label>

			<ul class="navigation__list">
			        <li class="first"><a href="/joomdle/login">My Account</a></li>
			        <li><a href="/joomdle/courses">Course Library</a></li>
			        <!-- li class="parent"><a href="#">Pacific Symposium</a>
			            <ul class="navigation__list navigation__drop hidden">
			                <li><a href="https://www.pacificcollege.edu/symposium">Live in San Diego</a></li>
			                <li><a href="/joomdle/pacific-symposium/streaming">Live Online</a></li>
			            </ul>
			        </li -->
			        <li><a href="/joomdle/course-access">My Courses</a></li>
			        <li><a href="/joomdle/support">Support</a></li>
			        <li class="navigation__list__last"><a href="https://pacificcenterforlifelonglearning.com/library/podcast">Podcast</a></li>
    			</ul>
		</nav><!-- #site-navigation -->
		<script>
		    "use strict"; !(function () { var e = document.getElementsByClassName("parent")[0], n = document.getElementsByClassName("navigation__drop")[0]; e.addEventListener("click", (function () { n.classList.toggle("hidden") })), e.addEventListener("mouseover", (function () { n.classList.contains("hidden") || n.classList.remove("hidden") })), e.addEventListener("mouseout", (function () { n.classList.contains("hidden") && n.classList.add("hidden") })) })();
		</script>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
