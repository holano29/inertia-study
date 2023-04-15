<template>

<Link
    class="text-black-500 hover:unline"
    :class="{'font-bold underline' :active}">
    <slot/>
</Link>


</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default{
    components: { Link },
    props: {
        active: Boolean,
    },

};

// const props = defineProps({
//     active: Boolean
// });

</script>