<template>
    <div>
        <ul>
            <li v-for="language in languages" :key="language.id">
                {{ language.name }}
                <button @click="deleteLanguage(language.id)">Delete</button>
            </li>
        </ul>
        <CreateLanguage />
    </div>
</template>

<script>
import CreateLanguage from './CreateLanguageComponent.vue';

export default {
    components: {
        CreateLanguage
    },
    data() {
        return {
            languages: []
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/languages/')
            .then(response => {
                this.languages = response.data;
            });
    },
    methods: {
        deleteLanguage(id) {
            this.axios
                .delete(`http://localhost:8000/api/languages/${id}`)
                .then(response => {
                    let i = this.languages.findIndex(language => language.id === id);
                    if (i !== -1) {
                        this.languages.splice(i, 1);
                    }
                });
        }
    }
}
</script>
