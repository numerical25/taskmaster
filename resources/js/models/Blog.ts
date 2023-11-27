import User from "./User";


export default class Blog {
    title: string;
    content: string;
    owner_id: string;
    owner: User = new User();
}
