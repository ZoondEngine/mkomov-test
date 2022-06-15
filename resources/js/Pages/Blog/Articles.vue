<template>
<app-layout>
    <articles-grid-component :articles="$page.props.articles" />
</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import ArticlesGridComponent from "./Components/ArticlesGridComponent";
export default {
    name: "Articles",
    components: {ArticlesGridComponent, AppLayout}
}
</script>

<style scoped>

</style>
