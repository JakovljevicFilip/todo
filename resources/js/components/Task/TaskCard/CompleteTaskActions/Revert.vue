<template>
    <q-btn
        @click="complete"
        icon="history"
        round
        color="accent"
        size="lg"
    >
        <q-tooltip>
            Revert
        </q-tooltip>
    </q-btn>
</template>
<script lang="ts" setup>
import { inject } from 'vue';
import { revertTask } from '../../../../services/TaskService';
import { useTaskStore } from '../../../../stores/TaskStore';

const task = inject('task');

const taskStore = useTaskStore();

const complete = async () => {
    await revertTask(task.value);
    taskStore.removeTask(task.value);
}
</script>
<style scoped>

</style>
