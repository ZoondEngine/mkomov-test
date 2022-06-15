<template>
    <app-layout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto flex flex-col">
                <div class="lg:w-4/6 mx-auto">
                    <div class="rounded-lg h-64 overflow-hidden">
                        <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1200x500">
                    </div>
                    <div class="flex flex-col sm:flex-row mt-10">
                        <div class="sm:w-2/3 sm:pl-8 sm:py-8 mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                            <h2 class="text-3xl font-bold pt-2 pb-5 ">{{ article.title }}</h2>
                            <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>{{ article.views }}
              </span>
                            <span @click="like" class="cursor-pointer hover:text-blue-700 text-gray-400 inline-flex items-center leading-none text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
</svg> {{ article.likes }}
              </span>
                            <p class="leading-relaxed text-lg mb-4 mt-4">{{ article.body }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 my-4"></div>
                    <h2 class="text-2xl font-bold pt-2 pb-5 ">Оставить комментарий</h2>
                    <form>
                        <div class="mb-6">
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Текст сообщения</label>
                            <input v-model="comment.subject" type="text" id="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Текст сообщения" required="">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Сообщение</label>
                            <textarea v-model="comment.body" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Сообщение"></textarea>
                        </div>
                        <button @click="sendComment" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Отправить комментарий</button>
                    </form>
                    <div class="border-t border-gray-200 my-4"></div>
                    <h2 class="text-2xl font-bold pt-2 pb-5 ">Комментарии</h2>
                    <template v-for="comment in article.comments">
                        <h2 class="text-3xl font-bold pt-2 pb-5 ">{{ comment.subject }}</h2>
                        <p class="leading-relaxed text-lg mb-4 mt-4">{{ comment.body }}</p>
                        <div class="border-t border-gray-100 my-4"></div>
                    </template>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
    name: "Article",
    components: {AppLayout},
    data() {
        return {
            article: this.$page.props.article,
            comment: this.$inertia.form({
                subject: '',
                body: ''
            })
        }
    },

    async mounted() {
        await this.view();
    },

    methods: {
        async like() {
            let response = await axios.put(`http://127.0.0.1:8000/api/article/${this.article.id}/like`);
            this.article.likes = response.data.data.likes;
        },

        async view() {
            let response = await axios.put(`http://127.0.0.1:8000/api/article/${this.article.id}/view`);
            this.article.views = response.data.data.views;
        },

        async sendComment() {
            let response = await axios.post(`http://127.0.0.1:8000/api/comment/${this.article.id}/create`, this.comment);

            this.$inertia.get(route(route().current(), {
                article: this.article.id
            }));
        }
    }
}
</script>

<style scoped>

</style>
