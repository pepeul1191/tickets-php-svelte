import App from '../components/Layouts/App.svelte';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'font-awesome/css/font-awesome.min.css';
import '../stylesheets/styles.css';

const app = new App({
	target: document.body,
	props: {
		name: 'world'
	}
});

export default app;