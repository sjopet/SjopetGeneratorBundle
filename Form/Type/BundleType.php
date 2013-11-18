<?php
/*
* (c) Sjopet Internetdiensten
*
* Richard van den Brand <richard@sjopet.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Sjopet\Bundle\GeneratorBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name', 'required' => true))
            ->add('namespace', 'text', array('label' => 'Namespace', 'required' => true))
            ->add('path', 'text', array('label' => 'Directory', 'required' => true))
            ->add('configType', 'text', array('label' => 'Configuration type', 'required' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sjopet\Bundle\GeneratorBundle\Model\BundleMetadata'
        ));
    }

    public function getName()
    {
        return 'sjopet_generator_form_bundle';
    }
}
