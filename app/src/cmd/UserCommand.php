<?php
namespace Blog\Cmd;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Blog\Curl\CurlInterface;
use Blog\Db\DbConn;
use Blog\Repo\UserRepository;


class UserCommand extends Command
{

    protected function configure()
    {
        $this->setName("user")->setDescription("User command")
            ->addArgument("id", InputArgument::REQUIRED, "REQUIRED! Enter user ID [1..100]")
            ->addArgument("rel", InputArgument::OPTIONAL)
            ->addUsage("user 1 [post]");
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument('id');
        $userRel = $input->getArgument('rel');

        $ch=new CurlInterface(['users', $userId, $userRel]);
        
        $output->writeln(sprintf("Path: %s", $ch->getPath()));

        $user = $ch->call();

        $userRepo = new UserRepository();


        $userRepo->saveUser([
            'id' => intval($user->id),
            'name' => strval($user->name),
            'username' => strval($user->username),
            'email' => strval($user->email),
            'phone' => $user->phone ?? "",
            'website' => $user->website ?? ""
        ]);

        $userRepo->saveUserAddress([
            "user_id" => $user->id,
            "zipcode" => $user->address->zipcode,
            "city" => $user->address->city ?? "",
            "suite" => $user->address->suite ?? "",
            "street" => $user->address->street ?? "",
            "geo_lat" => $user->address->geo->lat ?? "",
            "geo_lng" => $user->address->geo->lng ?? ""
        ]);

        $userRepo->saveUserCompany([
            "user_id" => $user->id,
            "name" => $user->company->name,
            "catch_phrase" => $user->company->catchPhrase,
            "bs" => $user->company->bs,
        ]);




        $output->writeln(sprintf("User id: %d", $userId));
        $output->writeln(sprintf("User relation: %s", $userRel));
    }
}