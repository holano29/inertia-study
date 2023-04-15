<template>

<div class="mt-5">
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-2"
            :class="{ 'text-gray-300' : !link.url, 'font-bold text-blue-600' : link.active }"
        />
        <!-- :class="link.url ? '' : 'text-gray-500'" -->
    </div>
</div>

</template>

<script>
export default {
    props: {
        links: Array,
    }
}
</script>