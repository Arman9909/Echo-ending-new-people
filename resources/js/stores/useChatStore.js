/*import { defineStore } from 'pinia'
import axios from '../api/axios'

export const useChatStore = defineStore('chat', {
    state: () => ({
        messages: [],
        loading: false,
    }),

    actions: {
        async loadMessages(conversationId) {
            this.loading = true
            const res = await axios.get(`/messages/${conversationId}`)
            this.messages = res.data
            this.loading = false
        },

        async sendMessage(conversationId, text) {
            const res = await axios.post(`/messages`, {
                conversation_id: conversationId,
                text
            })
            this.messages.push(res.data)
        }
    }
})*/
import { defineStore } from 'pinia'
import axios from '../api/axios'

export const useChatStore = defineStore('chat', {
    state: () => ({
        messages: [],
        buttons: [],
        loading: false,
        // 🔥 ДОБАВЛЯЕМ КНИГИ
        books: [
            {
                id: 1,
                title: "Колобок",
                pdf: "kolobok.pdf",
                audio: "kolobok.mp3"
            }
        ],

        // 🔥 выбранная книга
        selectedBook: null,
    }),

    actions: {
        addMessage(message) {
            this.messages.push(message)
        },

        async uploadImage(conversationId, file) {
            const formData = new FormData()
            formData.append('image', file)
            formData.append('conversation_id', conversationId)

            const res = await axios.post('/chat/upload-image', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })

            this.messages.push(res.data)
        },


        async loadMessages(conversationId) {
            this.loading = true
            const res = await axios.get(`/chat/${conversationId}`)
            this.messages = res.data
            this.loading = false
        },

        /*async sendMessage(conversationId, text) {
            const res = await axios.post('/chat/send', {
                conversation_id: conversationId,
                text
            })

            // Добавляем сообщение пользователя
            this.messages.push(res.data.user_message)
            // Добавляем сообщение бота
            this.messages.push(res.data.bot_message)
            if (response.data.bot_message.buttons) {
                this.buttons = response.data.bot_message.buttons
            } else {
                this.buttons = []
            }

        }*/
        async sendMessage(conversationId, text) {
            // 🔥 ЛОКАЛЬНАЯ ЛОГИКА: команда /start
            if (text === "/start") {
                const res = await axios.post('/chat/send', {
                    conversation_id: conversationId,
                    text
                })
                if (text === "choose_book") {
                    this.buttons = this.books.map(book => ({
                        text: "select_book_" + book.id,
                        label: book.title
                    }))

                    this.messages.push({ user_id: 0, text: "Выберите книгу из списка:" })
                    return
                }


                // сообщения
                this.messages.push(res.data.user_message)
                this.messages.push(res.data.bot_message)

                // кнопки сервера (Help/FAQ/Restart)
                this.buttons = res.data.bot_message.buttons ?? []

                // добавляем кнопку Колобок
                // добавляем кнопку "Выбрать книгу"
                this.buttons.push({
                    text: "choose_book",
                    label: "Выбрать книгу"
                })

                return
            }
            // 🔥 ЛОГИКА КНОПКИ "ВЫБРАТЬ КНИГУ"
            if (text === "choose_book") {
                this.buttons = this.books.map(book => ({
                    text: "select_book_" + book.id,
                    label: book.title
                }))

                this.messages.push({
                    user_id: 0,
                    text: "Выберите книгу из списка:"
                })

                return
            }

            // 🔥 ЛОКАЛЬНАЯ ЛОГИКА: выбор книги
            if (text.startsWith("select_book_")) {
                const id = Number(text.replace("select_book_", ""))
                this.selectedBook = this.books.find(b => b.id === id)

                this.buttons = [
                    { text: "download_pdf", label: "📘 Скачать книгу" },
                    { text: "download_audio", label: "🎧 Скачать аудиофайл" },
                    { text: "/start", label: "Начать историю" }
                ]

                this.messages.push({ user_id: 1, text: this.selectedBook.title })
                this.messages.push({
                    user_id: 0,
                    text: "Вы выбрали книгу: " + this.selectedBook.title
                })

                return
            }
// 🔥 Скачать PDF
            if (text === "download_pdf" && this.selectedBook) {
                window.location.href = "/storage/books/" + this.selectedBook.pdf
                return
            }

// 🔥 Скачать аудио
            if (text === "download_audio" && this.selectedBook) {
                window.location.href = "/storage/books/" + this.selectedBook.audio
                return
            }

            const res = await axios.post('/chat/send', {
                conversation_id: conversationId,
                text
            })

            // Добавляем сообщение пользователя
            this.messages.push(res.data.user_message)

            // Добавляем сообщение бота
            this.messages.push(res.data.bot_message)

            // Сохраняем кнопки, если они есть
            // Если книга ещё НЕ выбрана — скрываем кнопки скачивания
            // Если книга выбрана — показываем кнопки скачивания
            // Если книга выбрана — показываем кнопки скачивания
            if (this.selectedBook) {
                this.buttons = [
                    { text: "download_pdf", label: "📘 Скачать книгу" },
                    { text: "download_audio", label: "🎧 Скачать аудиофайл" }
                ]
            } else {
                // Если книга НЕ выбрана — показываем кнопки сервера
                this.buttons = res.data.bot_message.buttons ?? []
            }





        }
    }
})

