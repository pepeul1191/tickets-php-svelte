import App from '../components/Layouts/App.svelte';
import 'animate.css/animate.min.css';
import 'owl.carousel2/dist/assets/owl.carousel.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../stylesheets/styles.css';
import 'jquery/dist/jquery.min.js';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'wowjs/dist/wow.min.js';
import 'jquery.easing/jquery.easing.min.js';
import 'waypoints/lib/noframework.waypoints.min.js';
// import 'owl.carousel2/dist/owl.carousel.min.js';
/*import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'font-awesome/css/font-awesome.min.css';
import '../stylesheets/constants.css';
import '../stylesheets/styles.css';
import '../stylesheets/responsive-styles.css';*/

const app = new App({
	target: document.body,
	props: {
		name: 'world'
	}
});

export default app;