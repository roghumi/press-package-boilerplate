<?php

namespace Roghumi\Press\LaraPressPackage\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class InstallScripts extends CommandCommand
{
    protected static $defaultDescription = 'Post install scripts.';


    public function configure()
    {
        $this->setName('larapress:post-package-install');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Welcome to LaraPress package maker.");
        $output->writeln("This tool will prepare an environment for developing LaraPress packages.");
        // ...

        /** @var QuestionHelper */
        $helper = $this->getHelper('question');
        $question1 = new Question('Provide a package name: ', 'Sample');
        $packageName = $helper->ask($input, $output, $question1);

        $projectBase = __DIR__ . '/../../';
        $placeholderValues = [
            'packagename' => Str::lower($packageName),
            'LaraPressPackage' => $packageName,
        ];

        $this->renamePackageFiles($packageName);
        $this->replacePlaceholderNameInFile(
            $projectBase.'src/Providers/PackageServiceProvider.php',
            $placeholderValues,
        );
        $this->replacePlaceholderNameInFile(
            $projectBase.'composer.json',
            $placeholderValues,
        );
        unlink($projectBase.'src/Commands/InstallScripts.php');

        return Command::SUCCESS;
    }

    public static function renamePackageFiles($package)
    {
        $projectBase = __DIR__ . '/../../';
        $lowerCase = Str::lower($package);

        rename($projectBase . 'config/press/packagename.php', $projectBase . 'config/press/' . $lowerCase . '.php');
        rename($projectBase . 'lang/en/packagename.php', $projectBase . 'lang/en/' . $lowerCase . '.php');
        rename($projectBase . 'lang/fa/packagename.php', $projectBase . 'lang/fa/' . $lowerCase . '.php');
        rename($projectBase . 'routes/packagename.php', $projectBase . 'routes/' . $lowerCase . '.php');
    }

    public static function replacePlaceholderNameInFile($filename, $placeholders)
    {
        $fileContents = file_get_contents($filename);

        foreach ($placeholders as $placeholder => $value) {
            $fileContents = Str::replace($placeholder, $value, $fileContents);
        }

        file_put_contents($filename, $fileContents);
    }
}
