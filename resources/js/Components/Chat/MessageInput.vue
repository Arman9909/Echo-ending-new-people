<template>
    <div>
        <form @submit.prevent="send" class="d-flex p-2 border-top bg-white">
            <input
                v-model="text"
                class="form-control me-2"
                placeholder="Введите сообщение..."
            />

            <button class="btn btn-primary">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

        <div class="bottom-buttons" v-if="store.buttons.length">
            <label class="bottom-button file-btn">
                <input type="file" @change="handleFileSelect" accept="image/*" hidden>
                <span v-if="fileSelected" style="color: green;">✔ Файл выбран</span>
                <span v-else style="color: red;">✖ Файл не выбран</span>
            </label>


            <button
                v-for="btn in store.buttons"
                :key="btn.text"
                @click="sendQuick(btn.text)"
                class="bottom-button"
            >
                {{ btn.label }}
            </button>







        </div>
    </div>
</template>

<script>
import { useChatStore } from '../../stores/useChatStore'

export default {
    props: {
        conversationId: Number
    },

    data() {
        return {
            text: '',
            fileSelected: false,
            selectedFile: null
        }
    },

    setup() {
        const store = useChatStore()
        return { store }
    },

    methods: {
        async handleFileSelect(event) {
            const file = event.target.files[0]
            if (!file) return

            this.fileSelected = true
            this.selectedFile = file
        },

        async send() {
            // отправляем текст
            if (this.text.trim()) {
                await this.store.sendMessage(this.conversationId, this.text)
            }

            // отправляем файл
            if (this.selectedFile) {
                await this.store.uploadImage(this.conversationId, this.selectedFile)
            }

            // очищаем
            this.text = ''
            this.selectedFile = null
            this.fileSelected = false
        },


        async sendQuick(command) {
            await this.store.sendMessage(this.conversationId, command)
        //    this.store.buttons = []
        },
        downloadBook() {
            window.location.href = '/storage/books/mybook.pdf'
        },

        downloadAudio() {
            window.location.href = '/storage/books/mybook.mp3'
        },
        startStory() {
            this.store.sendMessage(this.conversationId, '/start')
        }


    }
}

</script>

<style scoped>
.bottom-buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* две кнопки в ряд */
    gap: 10px;
    padding: 10px;
    background: #fff8e1; /* мягкий кремовый фон */
    border-top: 1px solid #f0dca3;
}

.bottom-button {
    background: #ffd27f; /* тёплый жёлтый */
    border: 1px solid #e0b45c;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
    color: #4a2c00;
    cursor: pointer;
    transition: 0.2s;
    text-align: center;
}

.bottom-button:hover {
    background: #ffbf4d;
}

.file-btn {
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
