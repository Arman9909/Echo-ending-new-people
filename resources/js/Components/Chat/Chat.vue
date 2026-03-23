
<template>
    <div class="card shadow-sm">
        <div class="card-header">
            <i class="fa-solid fa-comments"></i> Чат
        </div>

        <MessagesList @button-click="handleButtonClick" />
        <MessageInput :conversationId="conversationId" />
    </div>
</template>

<script>
import MessagesList from './MessagesList.vue'
import MessageInput from './MessageInput.vue'
import { useChatStore } from '../../stores/useChatStore.js'

export default {
    components: { MessagesList, MessageInput },

    props: ['conversationId'],
    methods: {
        handleButtonClick(btn) {
            const store = useChatStore()
            store.sendMessage(this.conversationId, btn.command || btn.text)
        }
    },


    async mounted() {


            console.log("conversationId:", this.conversationId)


        const store = useChatStore()
        await store.loadMessages(this.conversationId)

        if (store.messages.length === 0) {
            store.addMessage({
                id: Date.now(),
                user_id: 0,
                text: 'Здравствуйте! Я — помощник echo-ending.<br>\n' +
                    '        Помогу вам выбрать книгу, создать альтернативный сюжет<br>\n' +
                    '        и пройти историю так, как хотите вы.<br><br>\n' +
                    '        С чего начнём?',
                buttons: [
                    { text: "Help", command: "/help" },
                    { text: "FAQ", command: "/faq" },
                    { text: "Restart", command: "/start" },
                    { text: "Выбрать книгу", command: "/choose_book" },
                    { text: "Начать историю", command: "/start_story" }

                ],
                created_at: new Date().toISOString()
        })
        }
    }
}

</script>

