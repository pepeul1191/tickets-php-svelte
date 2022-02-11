import Admin from '../components/Layouts/Admin.svelte';
import 'bootstrap/js/dist/util';
import 'bootstrap/js/dist/dropdown.js';

const app = new Admin({
	target: document.body,
	props: {
		name: 'world'
	}
});

export default app;