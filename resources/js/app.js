import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import '../css/app.css';

// You can import several layouts to be applied
/// different pages
import Layout from './Shared/Layout.vue';

createInertiaApp({

  resolve: async name => {
    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue')
    );

    /**
     * if(!page.default.layout)
     *  page.default.layout = Layout;
     * 
     */

    // The default is the exported function from a Page
    // Then the layout is the one you set inside the default() function.

    if(page.default.layout === undefined ){
      page.default.layout = Layout;
    }

    //page.default.layout ??= Layout;

    // page.then((module) => {
    //   module.layout ??= Layout;
    // });

    // const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

    // return pages[`./Pages/${name}.vue`]

    return page;
  },
  
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .component("Head", Head)
      .mount(el)
  },

  title: title => `${title} - My App`,

}); // end of createInertiaApp

InertiaProgress.init({
  color: 'green',
  showSpinner: false,
});