<?php

namespace Kreemer\UX\AutoCompleteJS\Form;

use Kreemer\UX\AutoCompleteJS\Builder\AutoCompleteBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class AutoCompleteType extends AbstractType
{
    private AutoCompleteBuilderInterface $autoCompleteBuilder;

    public function __construct(AutoCompleteBuilderInterface $autoCompleteBuilder)
    {
        $this->autoCompleteBuilder = $autoCompleteBuilder;
    }

    /**
     * @param FormInterface<string> $form
     * @param array<mixed>          $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $choices = $view->vars['choices'];

        $selectedValue = null;
        $src = [];
        /** @var ChoiceView $choiceView */
        foreach ($choices as $choiceView) {
            $src[] = ['label' => $choiceView->label, 'value' => $choiceView->value];
            if ($form->getViewData() && $choiceView->value === $form->getViewData()) {
                $selectedValue = $choiceView->label;
            }
        }

        $autoComplete = $this->autoCompleteBuilder->createAutocomplete();
        $autoComplete->getDataModel()
            ->setSrc($src)
            ->setKeys(['label']);

        $autoComplete
            ->setAttributes(['class' => 'autoComplete_container'])
            ->setInputAttributes([]
                + ($selectedValue ? ['value' => $selectedValue] : [])
                + ($view->vars['required'] ? ['required' => 'required'] : [])
            )
            ->setDataAttributes(['name' => $view->vars['full_name'], 'value' => $form->getViewData()]);

        $view->vars['autoComplete'] = $autoComplete;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return EntityType::class;
    }
}
