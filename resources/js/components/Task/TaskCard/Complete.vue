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
import { PropType, defineProps } from 'vue';
import { Task } from '../../../types/Task.js';
import { completeTask } from '../../../services/TaskService';
import { useTaskStore } from '../../../stores/TaskStore';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const taskStore = useTaskStore();

const complete = async () => {
    await completeTask(props.task);
    taskStore.removeTask(props.task);
}
</script>
<style scoped>

</style>
