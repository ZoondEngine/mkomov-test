<template>
    <app-layout>
        <articles-grid-component :count="6" />
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import ArticlesGridComponent from "./Components/ArticlesGridComponent";
export default {
    name: "Index",
    components: {ArticlesGridComponent, AppLayout}
}
</script>

<style scoped>

</style>
