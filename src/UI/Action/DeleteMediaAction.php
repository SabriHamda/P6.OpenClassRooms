<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Domain\Repository\Interfaces\MediaRepositoryInterface;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\UI\Responder\Interfaces\DeleteMediaResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


/**
 * Class DeleteMediaAction
 * @package App\UI\Action
 */
class DeleteMediaAction
{

    /**
     * @var Security
     */
    private $security;

    /**
     * @var MediaRepositoryInterface
     */
    private $mediaRepository;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var
     */
    private $targetTrickDirectory;

    /**
     * DeleteMediaAction constructor.
     * @param Security $security
     * @param MediaRepositoryInterface $mediaRepository
     * @param TrickRepositoryInterface $trickRepository
     * @param $targetTricksDirectory
     */
    public function __construct(Security $security, MediaRepositoryInterface $mediaRepository, TrickRepositoryInterface $trickRepository, $targetTricksDirectory)
    {
        $this->security = $security;
        $this->mediaRepository = $mediaRepository;
        $this->trickRepository = $trickRepository;
        $this->targetTrickDirectory = $targetTricksDirectory;

    }

    /**
     * @Route("delete-media/{mediaId}", name="delete-media")
     * @param $mediaId
     * @param DeleteMediaResponderInterface $responder
     * @param Filesystem $filesystem
     * @return mixed
     */
    public function __invoke(Request $request, $mediaId, DeleteMediaResponderInterface $responder, Filesystem $filesystem)
    {

        $user = $this->security->getUser();
        $media = $this->mediaRepository->findOneBy(['id' => $mediaId]);
        $trick = $this->trickRepository->getTrickById($media->getTrick()->getId());
        $this->slug = $trick->getSlug();

        // check user credentials to remove media
        if ($user->getId() == $media->getUserId()) {
            //Check media type ex: image || video
            if ($media->getType() == 'image') {
                //Delete the image in the directory
                $file = $this->targetTrickDirectory . '/' . $media->getName();
                try {
                    $filesystem->remove($file);
                } catch (IOExceptionInterface $exception) {
                    echo "An error occurred while removing your file at " . $exception->getPath();
                }
            }
            //Remove media from database
            $this->mediaRepository->removeMedia($media);
            return $responder($request, $this->slug);
        } else {
            return $responder($request);
        }

    }

}
