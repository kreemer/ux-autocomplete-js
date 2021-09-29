
'use strict';

import { Application, Controller } from 'stimulus';
import { getByTestId, waitFor } from '@testing-library/dom';
import { clearDOM, mountDOM } from '@symfony/stimulus-testing';
import AutocompleteController from '../dist/controller';

class CheckController extends Controller {
    connect() {
        this.element.addEventListener('autocomplete:pre-connect', () => {
            this.element.classList.add('pre-connected');
        });

        this.element.addEventListener('autocomplete:connect', (event) => {
            this.element.classList.add('connected');
            this.element.autoCompleteJS = event.detail.autoCompleteJS;
        });
    }
}

const startStimulus = () => {
    const application = Application.start();
    application.register('check', CheckController);
    application.register('autocomplete', AutocompleteController);
};

describe('AutocompleteController', () => {
    let container;

    afterEach(() => {
        clearDOM();
    });

    it('connect without input', async () => {
        container = mountDOM(`
            <div
                data-testid="div"
                data-controller="check autocomplete"
            ></div>
        `);

        expect(getByTestId(container, 'div')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'div')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'div')).not.toHaveClass('pre-connected');
        });

        expect(getByTestId(container, 'div')).not.toHaveClass('connected');
    });

    it('connect without options', async () => {
        container = mountDOM(`
            <div
                data-testid="div"
                data-controller="check autocomplete"
            ></div>
        `);

        expect(getByTestId(container, 'div')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'div')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'div')).toHaveClass('pre-connected');
        });

        expect(getByTestId(container, 'div')).not.toHaveClass('connected');
    });

    it('connect without data src options', async () => {
        container = mountDOM(`
            <div
                data-testid="div"
                data-controller="check autocomplete"
                data-autocomplete-config-value="{ &quot;data&quot;: { &quot;test&quot;: [&quot;Sauce - Thousand Island&quot;] } }"
            > <input type="text" data-autocomplete-target="input" /> </div>
        `);

        expect(getByTestId(container, 'div')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'div')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'div')).toHaveClass('pre-connected');
        });

        expect(getByTestId(container, 'div')).not.toHaveClass('connected');
    });

    it('connect with options', async () => {
        container = mountDOM(`
            <input id="autoComplete2" />
            <div
                data-testid="div"
                data-controller="check autocomplete"
                data-autocomplete-config-value="{ &quot;id&quot;: &quot;autoComplete2&quot;,&quot;data&quot;: { &quot;src&quot;: &#091;&quot;Sauce - Thousand Island&quot; &#093; } }"
                >
                <input type="text" data-autocomplete-target="input" />
            </div>
        `);

        expect(getByTestId(container, 'div')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'div')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'div')).toHaveClass('pre-connected');
            expect(getByTestId(container, 'div')).toHaveClass('connected');
        });

        const autoCompleteJS = getByTestId(container, 'div').autoCompleteJS;
        expect(autoCompleteJS.options.id).toBe('autoComplete2');
    });

});