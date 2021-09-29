'use strict';

import { Controller } from 'stimulus';
import autoComplete from "@tarekraafat/autocomplete.js/dist/autoComplete"
import "./controller.css"

export default class extends Controller {

    static values = { config: Object }
    static targets = [ 'input', 'data' ]

    connect() {
        let config = this.configValue ?? {};
        this._dispatchEvent('autocomplete:pre-connect', {
            config: config,
            input: input
        });

        if (Object.keys(config).length === 0) {
            console.error('No configuration found');
            return;
        }
        if (!config.data || !config.data.src) {
            console.error('Missing data.src config parameter');
            return;
        }


        if (!this.hasInputTarget) {
            console.error('No input target found');
            return;
        }
        let input = this.inputTarget;

        config.selector = () => {
            return this.inputTarget;
        };

        const autoCompleteJS = new autoComplete(config);

        this._dispatchEvent('autocomplete:connect', { autoCompleteJS });

        autoCompleteJS.input.addEventListener("selection", (event) => {
            autoCompleteJS.input.blur();

            const selectionObject = event.detail.selection;

            let selection;
            if (selectionObject.key) {
                selection = selectionObject.value[selectionObject.key];
            } else {
                selection = selectionObject.value;
            }
            autoCompleteJS.input.value = selection;


            if (this.hasDataTarget) {
                let dataTarget = this.dataTarget;
                let value;
                if (selectionObject.value.value) {
                    value = selectionObject.value.value;
                } else {
                    value = selection;
                }
                dataTarget.value = value;
                this._dispatchEvent('autocomplete:bound', { dataTarget });

            }
        });
    }

    _dispatchEvent(name, payload = null, canBubble = false, cancelable = false) {
        const userEvent = document.createEvent('CustomEvent');
        userEvent.initCustomEvent(name, canBubble, cancelable, payload);

        this.element.dispatchEvent(userEvent);
    }
}

