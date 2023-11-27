



export default class TreeNodeService {
    key: string = '';
    label: string = '';
    data: string = '';
    icon: string = '';
    children: TreeNodeService[];


    constructor(key: string, label: string, data: string, icon: string, children: TreeNodeService[]) {
        this.key = key;
        this.label = label;
        this.data = data;
        this.icon = icon;
        this.children = children;
    }
}
