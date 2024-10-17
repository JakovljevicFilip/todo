<template>
    <q-btn
        @click="complete"
        icon="check"
        round
        color="positive"
        size="lg"
    >
        <q-tooltip>
            Complete
        </q-tooltip>
    </q-btn>
</template>
<script lang="ts" setup>
import { inject } from 'vue';
import { completeTask } from '../../../../services/TaskService';
import { useTaskStore } from '../../../../stores/TaskStore';

const taskStore = useTaskStore();
const task = inject('task');

const complete = async () => {
    await completeTask(task.value);
    taskStore.removeTask(task.value);
}
</script>
<style scoped>

</style>
