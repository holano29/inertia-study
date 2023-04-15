<template>

    <Head>
        <title>My App</title>
        <meta type="description"
            content="Information about My App"
            head-key="description"/>
    </Head>

    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <Link href="/"><h1 class="font-bold text-lg">App Main</h1></Link>
            <p class="text-md ml-4">Welcome Back, {{ username }}</p>

            <!-- <input type="text" value="My App"> -->

            <Nav/>

        </header> 
    </section>  

    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot/>
        </div>
    </section>
    

</template>

<script>
import Nav from './Nav.vue';

export default{
    components: { Nav },
    computed:{
        username(){
            return this.$page.props.auth.user.username;
        }
    }
    
};

</script>