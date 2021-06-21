<template>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        created() {
            console.log("app created");
        }
    }
</script>