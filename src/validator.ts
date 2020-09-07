const X_MIN = -5;
const X_MAX = 5;

export default class Validator {
    isInputValid(
        x: string,
        y: number[],
        r: number
    ): string[] {
        const errorArray = new Array<string>();

        if (this.checkX(x)) {
            errorArray.push(this.checkX(x))
        }

        if (this.checkR(r)) {
            errorArray.push(this.checkR(r))
        }

        if (this.checkY(y)) {
            errorArray.push(this.checkY(y))
        }

        return errorArray;
    }

    private checkX( value: string ): string {
        if (value === '0') {
            return "";
        }

        if (!Number(value)) {
            return "Field X must be a number";
        }

        if (Number(value) < X_MIN || Number(value) > X_MAX) {
            return "X is out of range";
        }

        return "";
    }

    private checkR( value: number ): string {
        return isNaN(value) ? "R must be chosen" : ""
    }

    private checkY( value: number[] ): string {
        return value.length == 0 ? "Y must be chosen" : ""
    }
}