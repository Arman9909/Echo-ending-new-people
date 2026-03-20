<template>
    <div ref="list" class="messages-list p-3">
        <MessageItem
            v-for="msg in allMessages"
            :key="msg.id"
            :message="msg"
            @button-click="$emit('button-click', $event)"
        />
    </div>
</template>

<script>
import { useChatStore } from '../../stores/useChatStore'
import MessageItem from './MessageItem.vue'

export default {
    components: { MessageItem },

    computed: {
        // реальные сообщения из Pinia
        messages() {
            const store = useChatStore()
            return store.messages
        },

        // тестовые сообщения
       testMessages() {
            return [
                {
                    id: -1,
                    user_id: 1,
                    text: 'Привет! Это тестовое сообщение.',
                    created_at: '2024-01-01 12:00:00'
                },
                {
                    id: -2,
                    user_id: 0,
                    text: 'Здравствуйте! Я бот и тоже тестируюсь.',
                    created_at: '2024-01-01 12:00:05'
                },
                {
                    id: -3,
                    user_id: 1,
                    text: 'Проверка отображения длинного текста. Всё работает?',
                    created_at: '2024-01-01 12:01:00'
                }
            ]
        },

        // объединяем тестовые + реальные
        allMessages() {
            return [...this.testMessages, ...this.messages]
    }

    },

    watch: {
        allMessages() {
            this.$nextTick(() => {
                this.scrollToBottom()
            })
        }
    },


    methods: {
        scrollToBottom() {
            const el = this.$refs.list
            if (el) {
                el.scrollTop = el.scrollHeight
            }
        },

        handleButtonClick(btn) {
            const store = useChatStore()
            store.sendMessage(btn.command || btn.text)
        }
    },



    mounted() {
        const store = useChatStore()

        if (this.conversationId) {
            store.loadMessages(this.conversationId)
        }

        this.scrollToBottom()
    }

}
</script>

<style scoped>
.messages-list {
    height: 400px;
    overflow-y: auto;
    background: #fff8e1;
    border-radius: 12px;
    padding: 10px;
}
</style>
