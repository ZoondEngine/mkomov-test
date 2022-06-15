<template>
    <div class="p-4 md:w-1/3">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="https://dummyimage.com/720x400" alt="blog">
            <div class="p-6">
                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ article.title }}</h1>
                <p class="leading-relaxed mb-3">{{ article.body }}</p>
                <div class="flex items-center flex-wrap ">
                    <Link :href="route('blog.view', {
                        article: article.id
                    })" class="cursor-pointer hover:text-blue-700 text-blue-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </Link>
                    <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>{{ article.views }}
              </span>
                    <span @click="like(article.id)" class="cursor-pointer hover:text-blue-700 text-gray-400 inline-flex items-center leading-none text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
</svg> {{ article.likes }}
              </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "ArticleBox",
    components: {
        Link
    },

    props: {
        reference: {
            Object
        }
    },

    data() {
        return {
            article: this.reference
        }
    },

    methods: {
        async like(articleId) {
            let response = await axios.put(`http://127.0.0.1:8000/api/article/${articleId}/like`);
            this.article.likes = response.data.data.likes;
        }
    }
}
</script>

<style scoped>

</style>
