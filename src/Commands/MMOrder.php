<?php

namespace Momo\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class MMOrder extends Command
{
    protected function configure()
    {
        $this->setName("Order")
            ->setDescription("get/set momo orders.")
            ->addOption(
                "set",
                "s",
                InputOption::VALUE_REQUIRED
            )
            ->addOption(
                "get",
                "g",
                InputOption::VALUE_REQUIRED
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $task = $input->getOptions();
        if (!empty($task['get'])) {
            $this->_getOrder($input, $output);
            return;
        }
        if (!empty($task['set'])) {
            $this->_setOrder($input, $output);
            return;
        }
    }

    protected function _setOrder(InputInterface $input, OutputInterface $output) {
    }

    protected function _getOrder(InputInterface $input, OutputInterface $output) {
    }
}
