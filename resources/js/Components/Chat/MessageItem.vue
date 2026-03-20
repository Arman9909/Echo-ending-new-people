<template>
    <div class="d-flex mb-2"
         :class="{
           'justify-content-end': isMine,
           'justify-content-start': !isMine
         }">
        <div class="p-2 rounded"
             :class="isBot ? 'bg-warning text-dark' : (isMine ? 'bg-primary text-white' : 'bg-light border')">
            <div>

                <span v-if="isBot">
                    <i class="fa-solid fa-robot me-1"></i>
                </span>

                <!-- ВЫВОД КАРТИНКИ -->
                <div v-if="message.image">
                    <img :src="message.image" class="img-fluid rounded mb-2" />
                </div>

                <!-- ВЫВОД ТЕКСТА -->
                <span v-html="(message.text || '').replace(/\n/g, '<br>')"></span>
            </div>
            <!-- КНОПКИ -->
            <div v-if="message.buttons && message.buttons.length" class="bot-buttons mt-2">
                <button
                    v-for="(btn, index) in message.buttons"
                    :key="index"
                    :class="btn.text === '/start' ? 'bot-button start-button' : 'bot-button'"
                    @click="$emit('button-click', btn)"
                >
                    {{ btn.text }}
                </button>
            </div>


<!--            <small class="text-muted">{{ message.created_at }}</small>-->
        </div>
    </div>
</template>

<script>
export default {
    props: ['message'],

    computed: {
        isMine() {
            return this.message.user_id === 1
        },
        isBot() {
            return this.message.user_id === 0 || this.message.user_id === 2
        }

    }
}
</script>
<style scoped>
    /* Сообщения — новый стиль */
.p-2 {
    border-radius: 14px !important;
    padding: 12px !important;
    max-width: 80%;
}

/* Сообщение бота */
    .bg-warning {
        background: linear-gradient(135deg, #ffe9b3, #ffd27f) !important;
        border: 1px solid #e0b45c !important;
        color: #4a2c00 !important;
        padding: 14px 18px !important;
        border-radius: 14px !important;
        font-weight: 600 !important;
        font-size: 15px !important;
        line-height: 1.55 !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }



    /* Сообщение пользователя */
    .bg-primary {
        background: #c48a4a !important;      /* светлый коричневый */
        border: 1px solid #a06d34 !important; /* тёмная рамка */
        color: #ffffff !important;
        font-weight: 600;
    }





    /* Время */
.text-muted {
    font-size: 11px;
    opacity: 0.7;
}

/* Кнопки */
    .bot-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* две кнопки в ряд */
        gap: 10px;
        margin-top: 10px;
    }


    .bot-button {
        padding: 8px 10px;
        font-size: 14px;
        border-radius: 10px;
        border: 1px solid #e0b45c;
        background: #ffd27f;
        color: #4a2c00;
        font-weight: 600;
        cursor: pointer;
        transition: 0.15s ease;
        white-space: normal;
        word-break: break-word;
        line-height: 1.2;
        text-align: center;
    }

    .bot-button:hover {
        background: #ffe9a6;
    }



    .bot-button:active {
    background: #ffdd80;
}
</style>
<style scoped>
.message-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.message-buttons button {
    background: #ffcc66; /* тёплый жёлтый */
    color: #4a2c00; /* тёмно-коричневый текст */
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.message-buttons button:hover {
    background: #ffb84d;
}
</style>
<style scoped>
.bot-message {
    background: #fff3d6; /* мягкий кремовый */
    padding: 12px 16px;
    border-radius: 12px;
    font-weight: 600; /* насыщенный текст */
    color: #3a2a00;
    line-height: 1.5;
}
.bg-warning {
    background: linear-gradient(135deg, #ffe9b3, #ffd27f) !important;
    border: 1px solid #e0b45c !important;
    color: #4a2c00 !important;
    padding: 14px 18px !important;
    border-radius: 14px !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    line-height: 1.55 !important;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

</style>
