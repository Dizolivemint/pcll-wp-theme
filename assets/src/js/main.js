import 'babel-polyfill';
import 'jquery/dist/jquery.min';
import 'bootstrap/dist/js/bootstrap.min';
import General from './_generalScripts';
import Search from './Search';

let search = new Search();

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
