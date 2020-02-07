import 'babel-polyfill';
import 'jquery/dist/jquery.min';
import 'bootstrap/dist/js/bootstrap.min';
import 'infinite-scroll/dist/infinite-scroll.pkgd.min';
import General from './_generalScripts';
import Search from './Search';
import Infinitescroll from './Infinitescroll';

let search = new Search();
let infiniteScroll = new Infinitescroll();

const App = {

	/**
	 * App.init
	 */
	init() {
		// General scripts
		function initGeneral() {
			return new General();
		}
		initGeneral();
	}

};

document.addEventListener('DOMContentLoaded', () => {
	App.init();
});
