import { NewTask } from './NewTask';

export interface Task extends NewTask {
    id: string;
    status: string;
    created_at: string;
    updated_at: string;
}
