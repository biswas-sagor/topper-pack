<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<template>
    <div class="ha-nav">
        <button
            v-if="prev"
            @click="setTab(prev)"
            class="prev"
            :disabled="loading">
            <?php esc_html_e('← Back', 'topper-pack'); ?>
        </button>
        <div v-else></div>

        <div class="nav-center">
            <button
                v-if="bepro"
                @click="setTab('bepro')"
                class="bepro"
                :disabled="loading">
                <?php esc_html_e('Be A Pro', 'topper-pack'); ?>
            </button>
        </div>

        <button
            v-if="next"
            @click="setTab(next)"
            class="next"
            :disabled="loading">
            <?php esc_html_e('Next →', 'topper-pack'); ?>
        </button>
        <button
            v-else-if="done"
            @click="setTab('done')"
            class="done"
            :disabled="loading">
            <?php esc_html_e('Done', 'topper-pack'); ?>
        </button>
        <div v-else></div>
    </div>
</template>

<script>
    export default {
        props: {
            prev: String,
            next: String,
            done: String,
            bepro: String
        },
        methods: {
            setTab(step) {
                this.$emit('set-tab', step);
            }
        }
    }
</script>