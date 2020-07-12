<?php

namespace GrumphpDrupalCheck;

use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use Symfony\Component\OptionsResolver\OptionsResolver;
use GrumPHP\Task\AbstractExternalTask;

/**
 * Drupal check task.
 */
class DrupalCheck extends AbstractExternalTask
{

  /**
   * @param ContextInterface $context
   *
   * @return bool
   */
  public function canRunInContext(ContextInterface $context): bool
  {
      return ($context instanceof GitPreCommitContext);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigurableOptions(): OptionsResolver
  {
      $resolver = new OptionsResolver();
      return $resolver;
  }

  /**
   * {@inheritdoc}
   */
  public function run(ContextInterface $context): TaskResultInterface
  {
    /** @var \GrumPHP\Collection\FilesCollection $files */
    $files = $context->getFiles();
    $triggered_by = [
      'php',
      'inc',
      'module',
      'install',
      'profile',
      'theme',
    ];
    $files = $files->extensions($triggered_by);
    if (0 === \count($files)) {
        return TaskResult::createSkipped($this, $context);
    }
    $arguments = $this->processBuilder->createArgumentsForCommand('drupal-check');
    $arguments->add('--deprecations');
    $arguments->add('--no-progress');
    $arguments->addFiles($files);
    $process = $this->processBuilder->buildProcess($arguments);
    $process->run();
    if (!$process->isSuccessful()) {
        $output = $this->formatter->format($process);
        return TaskResult::createFailed($this, $context, $output);
    }
    return TaskResult::createPassed($this, $context);
  }

}
