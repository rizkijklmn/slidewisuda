
export default () => ({
    async init() {
        // this.faculties = await (await fetch('/faculties', {
        //     headers: {
        //         'Accept': 'application/json'
        //     }
        // })).json();

        const body = await (await axios.get('/faculties', {
            headers: {
                Accept: 'application/json'
            }
        })).data;

        this.faculties = JSON.parse(JSON.stringify(body));



        console.log(this.faculties[0].name);
    },
    faculties: [],
    get indexFaculty() {
        return this.selectedFaculty;
    },
    set indexFaculty(value) {
        this.selectedFaculty = value;
    }
});
