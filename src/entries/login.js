import Login from '../components/Layouts/Login.svelte';
import '../stylesheets/login.css';

const app = new Login({
	target: document.body,
	props: {
		name: 'world'
	}
});

export default app;