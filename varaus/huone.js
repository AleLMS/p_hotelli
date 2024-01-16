export class Room {
    constructor(id, hotelliID, vuodepaikat) {
        this.id = id;
        this.hotelliID = hotelliID;
        this.vuodepaikat = vuodepaikat;
    }

    prepareRoom(templateID) {
        let template = document.getElementById(templateID).innerHTML;
        for (const [key, value] of Object.entries(this)) {
            const replace = "{{" + key + "}}";
            template = template.replace(replace, value);
        }
        return template;
    }

    // Could expose the first argument of the insertAdjacentHTML method for more control
    displayBefore(insertPoint, templateID) {
        let prepareRoom = this.prepareRoom(templateID);
        if (!document.getElementById('room' + this.id)) // Check that the message has not been displayed already
            insertPoint.insertAdjacentHTML('beforebegin', prepareRoom);
    }

}