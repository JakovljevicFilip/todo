export interface Task {
    id: string;
    title: string;
    description: string | null;
    scheduled: string | null;
    status: string;
    created_at: string;
    updated_at: string;
}
