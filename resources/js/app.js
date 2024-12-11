import '../css/app.css';
import './bootstrap';
import 'font-awesome/css/font-awesome.min.css';

// Import Inertia.js and Vue 3
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


// Application name (can be configured in .env)
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Create Inertia App and mount it
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Use Inertia plugin and Ziggy plugin
        app.use(plugin)
           .use(ZiggyVue) // This allows you to use Ziggy for route generation in Vue

        // Register the TodoList component globally (if needed)

        // Mount the Vue app
      app.mount(el);

      app.component('task-form', require('./Components/TodoList.vue').default);
        },

    progress: {
        color: '#4B5563',
    },
});
