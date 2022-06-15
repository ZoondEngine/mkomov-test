<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <template v-if="state.loading">
                    Loading ...
                </template>
                <template v-else>
                    <template v-for="tag in container.tags">
                        <Link :href="route('blog.articles.by-tags', {tag: tag.id})" class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ tag.title }}</Link>
                    </template>
                    <template v-if="count === 0">
                        <template v-for="article in container.articles.data">
                            <article-box :reference="article" />
                        </template>
                    </template>
                    <template v-else>
                        <template v-for="article in container.articles">
                            <article-box :reference="article" />
                        </template>
                    </template>
                </template>
            </div>

            <div class="my-4">
                <pagination v-if="count === 0" :links="container.articles?.links" />
            </div>
        </div>
    </section>
</template>

<script>
import ArticleBox from "./ArticleBox";
import Pagination from "./Pagination";
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "ArticlesGridComponent",
    components: {Pagination, ArticleBox, Link},
    props: {
        count: {
            Number,
            default: 0
        },
        articles: {
            Array,
            default: []
        }
    },

    data() {
        return {
            state: {
                loading: false
            },
            container: {
                articles: [],
                tags: []
            }
        }
    },

    async mounted() {
        await this.fetch();
    },

    methods: {
        async fetch() {
            this.loading = true;

            let response = await axios.get('http://127.0.0.1:8000/api/article/load/' + this.count);

            if(this.articles.length <= 0) {
                this.container.articles = response.data.articles;
            }
            else {
                this.container.articles = this.articles;
                console.log(this.container.articles);
            }

            this.container.tags = response.data.tags;

            this.loading = false;
        },
    }
}
</script>

<style scoped>

</style>
