import * as $ from "jquery";
import { FormData } from "./formData";

export default class FormDataExtractor {
    getFormData(): FormData {
        return <FormData> {
            x: this.getX(),
            y: this.getY(),
            r: this.getR()
        }
    }

    getY(): number[] {
        const numbers = [];
        $('input[name="y-group"]:checked').each(function() {
            numbers.push(Number($(this).val()));
        })
        return numbers;
    }

    getR(): number {
        return Number($('input[name="r-group"]:checked').val());
    }

    getX(): string {
        const xInput = $('#x');
        let x = (xInput.val() ? xInput.val() : "mokString") as string;

        if (x.includes(',')) {
            x = x.replace(",", ".")
        }

        return x.toString();
    }
}
